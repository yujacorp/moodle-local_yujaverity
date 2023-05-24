function checkExtension(hostname) {
    return new Promise((resolve, reject) => {
        let iframe = document.createElement("iframe");
        iframe.id = "yuja-verity-extension-connect";
        iframe.style.display = "none";
        iframe.style.visibility = "hidden";
        iframe.src = "https://" + hostname + "/resources/themes/extension-connect.html";
        document.body.appendChild(iframe);
        iframe.onload = () => {
            iframe.contentWindow?.postMessage({
                require: "exists"
            }, "https://" + hostname);
        };
        iframe.onerror = () => {
            reject();
        };
        window.addEventListener("message", (ev) => {
            if (ev.origin !== "https://" + hostname) {
                console.debug(`Blocked message from origin ${ev.origin}`);
                return;
            }

            const message = ev.data;
            if (message?.require === "exists") {
                resolve(Boolean(message.result));
            }
        });
    });
}

function showBlockPage(hostname, blockPage) {
    let quizDisplay = document.getElementById("region-main-box");
    if (!quizDisplay) {
        return;
    }

    let notice = document.createElement("iframe");
    notice.id = "yuja-download-instructions";
    notice.width = quizDisplay.offsetWidth;
    notice.scrolling = "no";
    notice.src = "https://" + hostname + "/pages/take-quiz/block-access/" + blockPage + ".html?lms=moodle";
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
        }, "https://" + hostname);

    };

    window.addEventListener("message", (ev) => {
        if (ev.origin !== "https://" + hostname) {
            console.debug(`Blocked message from origin ${ev.origin}`);
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

// course_module_viewed_handler in rule.php hides the form, so unhide it
function showQuiz() {
    document.body.classList.remove("yujaverity");
}

function isTakeQuizPage() {
    // This is determined by the plugin code in rule.php, so it should always return true
    return true;
}

function isQuizProctored() {
    // This is determined by the plugin code in rule.php, so it should always return true
    return true;
}

export async function checkQuizAccess(hostname) {
    try {
        if (isTakeQuizPage() && isQuizProctored()) {
            if (window.chrome) {
                if (await checkExtension(hostname)) {
                    showQuiz();
                }
                else {
                    showBlockPage(hostname, "download-instructions");
                }
            } else {
                showBlockPage(hostname, "browser-instructions");
            }
        }
    } catch (err) {
        console.log("YuJa Verity encountered an error: " + err);
    }
}