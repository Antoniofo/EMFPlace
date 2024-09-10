var BASE_URL = "../server/requestHandler.php"

class Service {


    constructor() {
    }

    getPixels(callback) {
        $.ajax({
            type: "GET",
            url: BASE_URL + "?action=getpixels",
            success: callback
        })
    }

    drawPixel(id, color) {
        $.ajax({
            type: "POST",
            data: "action=draw&id=" + id + "&color=" + color,
            url: BASE_URL
        })
    }

    resetToWhite() {
        $.ajax({
            type: "POST",
            data: "action=reset",
            url: BASE_URL,
            success: (data) => {
                alert(data)
            },
            error: (var1,var2,var3) => {
                alert(var2 + " : "+ var3)
            }
        })
    }

    login(password) {
        $.ajax({
            type: "POST",
            data: "action=login&password=" + password,
            url: BASE_URL,
            success: () => {
                window.location.href = "./admin.html"
            }
        })
    }

    stop() {
        $.ajax({
            type: "POST",
            data: "action=stop",
            url: BASE_URL,
            success: () => {
                window.location.href = "./index.html"
            }
        })
    }
}