$().ready(function () {
    wrk = new Service();
    window.ctrl = new IndexCtrlView();
    //wrk.centraliserErreurHttp(ctrl.afficherErreurHttp);
});

class IndexCtrlView {
    /**
     * Constructor of IndexCtrl. Call the wrk to check if the user is connected.
     */
    constructor() {
        const portrait = window.matchMedia("(orientation: portrait)").matches;
        if (portrait) {
            alert("Veuillez-vous mettre en mode paysage")
        } else {
            wrk.getPixels(this.callback)
            setInterval(()=> {wrk.getPixels(ctrl.callback)},500)
        }
        window.matchMedia("(orientation: portrait)").addEventListener("change", e => {
            const portrait = e.matches;

            if (portrait) {
                window.location.reload();
            } else {
                wrk.getPixels(ctrl.callback)
                setInterval(()=> {wrk.getPixels(ctrl.callback)},500)
            }
        });

    }


    callback(data) {
        const dataArray = data.split(",");
        const canvas = document.querySelector(".canvas");
        $(".canvas").empty()
        dataArray.forEach((item) => {
            if (item) {
                const [id, color] = item.split("-");
                const tag = document.createElement("div");
                tag.className = "pixel";
                tag.style.backgroundColor = color;
                tag.id = id;
                canvas.append(tag);
            }
        });
        $(".pixel").on("click", function (e) {
            var id = $(this).attr("id")
            var color = $("#colorpicker").val()
            e.target.style.backgroundColor = color;
            wrk.drawPixel(id, color);
        })
    }
}