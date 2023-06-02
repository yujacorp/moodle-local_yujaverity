/**
 * Checks whether the YuJa Verity browser extension is enabled
 * @param {string} verityHostname hostname of Verity server
 * @returns {Promise<boolean>} whether the extension is enabled
 */
function checkExtension(verityHostname) {
    return new Promise((resolve, reject) => {
        let iframe = document.createElement("iframe");
        iframe.id = "yuja-verity-extension-connect";
        iframe.style.display = "none";
        iframe.style.visibility = "hidden";
        iframe.src = "https://" + verityHostname + "/resources/themes/extension-connect.html";
        document.body.appendChild(iframe);
        iframe.onload = () => {
            iframe.contentWindow?.postMessage({
                require: "exists"
            }, "https://" + verityHostname);
        };
        iframe.onerror = () => {
            reject();
        };
        window.addEventListener("message", (ev) => {
            if (ev.origin !== "https://" + verityHostname) {
                return;
            }

            const message = ev.data;
            if (message?.require === "exists") {
                resolve(Boolean(message.result));
            }
        });
    });
}

/**
 * Shows a page blocking access to the quiz
 * @param {string} verityHostname hostname of Verity server
 * @param {string} blockPage type of block page
 */
function showBlockPage(verityHostname, blockPage) {
    let quizDisplay = document.getElementById("region-main-box");
    if (!quizDisplay) {
        return;
    }

    let notice = document.createElement("iframe");
    notice.id = "yuja-download-instructions";
    notice.width = quizDisplay.offsetWidth;
    notice.scrolling = "no";
    notice.src = "https://" + verityHostname + "/pages/take-quiz/block-access/" + blockPage + ".html?lms=moodle";
    notice.style.border = "none";
    notice.style.transition = "all 0.5s ease-in-out 0s";
    notice.height = "0px";
    notice.width = "100%";
    notice.style.paddingLeft = "15px";
    notice.style.paddingRight = "15px";

    quizDisplay.style.display = "none";
    quizDisplay.style.visibility = "hidden";
    quizDisplay.parentNode.appendChild(notice);

    notice.onload = () => {
        notice.contentWindow.postMessage({
            event: "init-auth-instructions",
            authLink: undefined
        }, "https://" + verityHostname);

    };

    window.addEventListener("message", (ev) => {
        if (ev.origin !== "https://" + verityHostname) {
            return;
        }

        const message = ev.data;
        if (message?.event === "instructions-resize") {
            if (message.scrollHeight) {
                notice.height = message.scrollHeight;
            }
            if (message.scrollWidth) {
                notice.width = "100%";
            }
            if (!message.noScroll) {
                document.documentElement.scrollTop = 0;
            }
        }
    });
}

/**
 * Unhide the form hidden by course_module_viewed_handler in view_quiz.php
 */
function showQuiz() {
    document.body.classList.remove("yujaverity");
}

/**
 * Hides quiz page and shows block page depending on user's browser (called from event)
 * @param {string} verityHostname hostname of Verity server
 */
export async function checkQuizAccess(verityHostname) {
    try {
        if (window.chrome) {
            if (await checkExtension(verityHostname)) {
                showQuiz();
            } else {
                showBlockPage(verityHostname, "download-instructions");
            }
        } else {
            showBlockPage(verityHostname, "browser-instructions");
        }
    } catch (err) {
        // Ignore error
    }
}