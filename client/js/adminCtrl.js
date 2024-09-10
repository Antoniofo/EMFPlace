$().ready(function () {
    wrk = new Service();
    window.ctrlAdmin = new AdminCtrl();
    //wrk.centraliserErreurHttp(ctrl.afficherErreurHttp);
});

class AdminCtrl {
    constructor() {
    }

    resetToWhite() {
        wrk.resetToWhite()
    }
}