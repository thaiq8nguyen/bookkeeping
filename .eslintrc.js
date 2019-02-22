module.exports = {
    "extends": ["standard","plugin:vue/recommended"],
    "rules":{
        //Script Linting Rules
        "quotes":["warn","double"],
        "indent":["off", "tab"],
        "comma-dangle":["off"],
        "semi":["warn","always"],
        "eol-last":["off"],
        "no-trailing-spaces": ["error",{"skipBlankLines":true}],
        "padded-blocks": ["error", "always"],
        "no-tabs": ["error", {"allowIndentationTabs": true}],

        //Vue Linting Rules
        "vue/html-indent": ["off","tab"],
        "vue/html-self-closing":["off"],
        "vue/max-attributes-per-line":["error",{
            "singleline":3
        }],
        "vue/singleline-html-element-content-newline":["off"]
            


    }

    
};