const path = require("path");
const webpack = require("webpack");

module.exports = {
    resolve: {
        extensions: [". js", ".vue", ".json"],
        alias: {
            "Components": path.resolve(__dirname, "resources/js/components"),
            "Views": path.resolve(__dirname, "resources/js/views"),
            "Store": path.resolve(__dirname, "resources/js/store"),
            "Router": path.resolve(__dirname, "resources/js/router"),
            "Plugins": path.resolve(__dirname, "resources/js/plugins"),
            "Services": path.resolve(__dirname, "resources/js/services")
         }
    }
}