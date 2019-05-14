$(document).ready(function() {
    $("#assignForm").submit(function() {
        let token = $("input[name=_token]").val();
        let enseignant = $("input[name=enseignant_id]").val();
        let inputs = document
            .getElementById("area")
            .getElementsByTagName("input");
        let all = [];
        for (const input of inputs) {
            //si la valeur d'un seule input n'est pas un nombre mettre un message dans dom des notification et recharger la page
            all.push(input.value);
        }
        const chunk = (arr, size) =>
            Array.from({ length: Math.ceil(arr.length / size) }, (v, i) =>
                arr.slice(i * size, i * size + size)
            );
        all = chunk(all,4) 
        
        $.ajax({
            type: "POST",
            url: "/home/assignations/new",
            data:
                "data=" +
                JSON.stringify(all) +
                "&_token=" +
                token +
                "&enseignant_id=" +
                enseignant,
            dataType:'JSON'
        })
            .done(function(reponse) {
                alert(JSON.stringify(reponse));
                document.location.href='/home/assignations/'
            })
            .fail(function(reponse) {
                alert(JSON.stringify(reponse));
            });
        return false;
    });
});
