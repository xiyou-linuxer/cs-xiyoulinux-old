(function(window, $, undefined) {

    var Tags = {
        comTag: '<div class="com-mask" id="com-mask"></div>' + '<div class="com-panel" id="com-panel">' + '<div class="com-static"></div>' + '<div class="com-btn-wrapper"></div>' + '</div>',
        alertBtn: '<input type="button" class="com-btn com-alert-btn" value="确定">',
        cfmBtns: '<input type="button" class="com-btn cfm-false-btn" value="取消">' + '<input type="button" class="com-btn cfm-true-btn" value="确定">'
    }

    function JComs() {
        var configs = {};
        this.get = function(n) {
            return configs[n];
        }

        this.set = function(n, v) {
            configs[n] = v;
        }
        this.init();
    }

    JComs.prototype = {
        init: function() {
            this.createDom();
            this.bindEvent();
        },
        createDom: function() {
            var body = $("body"),
                com = $("#com-panel");

            if (com.length === 0) {
                body.append(Tags.comTag);
            }

            this.set("com", $("#com-panel"));
            this.set("mask", $("#com-mask"));
        },
        bindEvent: function() {
            var _this = this,
                com = _this.get("com"),
                mask = _this.get("mask");
            com.on("click", ".com-alert-btn", function(e) {
                _this.hide();
            });
            com.on("click", ".cfm-true-btn", function(e) {
                var cb = _this.get("cfmCallBack");
                _this.hide();
                cb && cb(true);
            });
            com.on("click", ".cfm-false-btn", function(e) {
                var cb = _this.get("cfmCallBack");
                _this.hide();
                cb && cb(false);
            });
            mask.on("click", function(e) {
                _this.hide();
            });
            $(document).on("keyup", function(e) {
                var kc = e.keyCode,
                    cb = _this.get("cfmCallBack");;
                if (kc === 27) {
                    _this.hide();
                } else if (kc === 13) {
                    _this.hide();
                    if (_this.get("type") === "confirm") {
                        cb && cb(true);
                    }
                }
            });
        },
        alert: function(str) {
            var str = typeof str === 'string' ? str : str.toString(),
                com = this.get("com");
            this.set("type", "alert");
            com.find(".com-static").html(str);
            if (typeof btnstr == "undefined") {
                com.find(".com-btn-wrapper").html(Tags.alertBtn);
            } else {
                com.find(".com-btn-wrapper").html(btnstr);
            }
            this.show();
        },
        confirm: function(str, callback) {
            var str = typeof str === 'string' ? str : str.toString(),
                com = this.get("com");
            this.set("type", "confirm");
            com.find(".com-static").html(str);
            com.find(".com-btn-wrapper").html(Tags.cfmBtns);
            this.set("cfmCallBack", (callback || function() {}));
            this.show();
        },
        show: function() {
            this.get("com").fadeIn();
            this.get("mask").fadeIn();
        },
        hide: function() {
            var com = this.get("com");
            com.find(".com-static").html("");
            com.find(".com-btn-wrapper").html("");
            com.fadeOut();
            this.get("mask").fadeOut();
        },
        destory: function() {
            this.get("com").remove();
            this.get("mask").remove();
            delete window.alert;
            delete window.confirm;
        }
    };

    var obj = new JComs();
    window.alert = function(str) {
        obj.alert.call(obj, str);
    };
    window.confirm = function(str, cb) {
        obj.confirm.call(obj, str, cb);
    };
})(window, $);