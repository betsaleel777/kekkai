function createElementFromHTML(htmlString) {
    var div = document.createElement("div");
    div.innerHTML = htmlString.trim();
    // Change this to div.childNodes to support multiple top-level nodes
    return div.firstChild;
}

function design(name, ue, position) {
    const htmlString =
        '<div class="column"><div class="ui card"><div class="content"><div class="header">' +
        name +
        "</div>" +
        '<div class="ui form"><div class="field"><input value="' +
        ue +
        '" hidden name="ue_id" type="text"><div class="ui left icon input"><input name="cm" type="text" placeholder="heures cm..."><i class="window minimize icon"></i></div><div hidden class="extra content"><i class="red exclamation circle icon"></i></div></div>' +
        '<div class="field"><div class="ui left icon input"><input name="td" type="text" placeholder="heures td..."><i class="window minimize icon"></i></div><div hidden class="extra content"><i class="red exclamation circle icon"></i></div></div>' +
        '<div class="field"><div class="ui left icon input"><input name="tp" type="text" placeholder="heures tp..."><i class="window minimize icon"></i></div><div hidden class="extra content"><i class="red exclamation circle icon"></i></div></div>' +
        "</div></div>" +
        '<div onclick="erase(this)" class="ui bottom attached button orange"><i class="times icon"></i>supprimer</div></div>' +
        "</div>";
    position.append(createElementFromHTML(htmlString));
}

function assign() {
    $("#ue_field").dropdown("setting", "onAdd", (value, text) => {
        design(text, value, $("#area"));
    });
}
