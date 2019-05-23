function createElementFromHTML(htmlString) {
    var div = document.createElement("div");
    div.innerHTML = htmlString.trim();
    // Change this to div.childNodes to support multiple top-level nodes
    return div.firstChild;
}

function design(name, ue, position) {
    const htmlString =
        '<div id="'+ue+'" class="column"><div class="ui orange card"><div class="content"><div class="header">' +
        name +
        "</div>" +
        '<div class="ui form">'+
        '<div class="field"><div class="ui left icon input"><input hidden value="'+ue+'" /><input ue="'+ue+'" onblur="verify(this)" name="cm" type="text" placeholder="heures cm..."><i class="window minimize icon"></i></div><div hidden class="extra content"></div></div>' +
        '<div class="field"><div class="ui left icon input"><input ue="'+ue+'" name="td" onblur="verify(this)" type="text" placeholder="heures td..."><i class="window minimize icon"></i></div><div hidden class="extra content"></div></div>' +
        '<div class="field"><div class="ui left icon input"><input ue="'+ue+'" name="tp" onblur="verify(this)" type="text" placeholder="heures tp..."><i class="window minimize icon"></i></div><div hidden class="extra content"></div></div>' +
        "</div></div>" +
        '</div>' +
        "</div>";
    position.append(createElementFromHTML(htmlString));
}

function assign() {
    $("#ue_field").dropdown("setting", "onAdd", (value, text) => {
        design(text, value, $("#area"));
    });
}
