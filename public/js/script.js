class App {
    #preContainers = document.querySelectorAll("pre");
    constructor() {
        console.log("🔥 Welcome on PHP Starter kit ! 🔥\r\nPlease feel free to edit js in public/js directory.");
        this._setCodeCopyLink();
    }

    _setCodeCopyLink() {
        this.#preContainers.forEach(pre => {
            const copyLink = document.createElement("a");
            copyLink.innerHTML = "📋";
            copyLink.href = "#";
            copyLink.title = "Copy";
            const initialize = () => {
                copyLink.innerHTML = "📋";
                pre.classList.remove("snapshot");
            }
            copyLink.addEventListener("click", (e) => {
                e.preventDefault();
                initialize();
                navigator.clipboard.writeText(pre.querySelector("code").innerText);
                pre.classList.add("snapshot");
                copyLink.innerHTML = "✅";
                setTimeout(() => {
                    initialize();
                }, 400);
            });
            pre.append(copyLink);
        });
    }
}

new App();
