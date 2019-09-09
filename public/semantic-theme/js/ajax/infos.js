//fonction ajax qui à partir de l'id de l'enseignant selectionné retourne un tableau contenant les ues enseignées:
//libelle -- cm -- td -- tp et les totaux
function infos() {
    // const array_sum = function(array) {
    //     let key
    //     let sum = 0
    //     // input sanitation
    //     if (typeof array !== 'object') {
    //         return null
    //     }
    //     for (key in array) {
    //         if (!isNaN(parseFloat(array[key]))) {
    //             sum += parseFloat(array[key])
    //         }
    //     }
    //     return sum
    // }

    // cette fonction permet de fabriquer le body du tableau en iterant l'objet
    //qui contient les inforations relatives aux ues enseignées
    const parcours = function(iterable) {
        calebasse = ''
        for (ue of iterable) {
            calebasse += `<tr><td>${ue.libelle}</td>
                      <td>${ue.cm}</td>
                      <td>${ue.td}</td>
                      <td>${ue.tp}</td></tr>`

        }
        return calebasse
    }
    //cette fonction permet de placer à l'interieur d'un tableau HTML
    //les information d'ues relative à l'enseignant
    const printUes = function(ues, total) {
        return `<div class="">
        <table id="tableau" class="ui blue celled table">
            <thead>
                <tr>
                    <th>UE</th>
                    <th>CM</th>
                    <th>TD</th>
                    <th>TP</th>
                </tr>
            </thead>
            <tbody>
                ${parcours(ues)}
            </tbody>
            <tfoot>
               <tr class="positive">
                 <td>TOTAL</td>
                 <td>${total.cm}</td>
                 <td>${total.td}</td>
                 <td>${total.tp}</td>
               </tr>
            </tfoot>
        </table>
    </div>`
    }
    const teacher = document.querySelector('input[name="enseignant_id"]').value;
    const token = document.querySelector('input[name="_token"]').value;
    fetch('/home/enseignant/infos', {
        method: 'post',
        credentials: "same-origin",
        headers: {
            'Content-type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
            teacher
        })
    }).then((response) => {
        response.json().then((data) => {
            console.log(data);
            document.getElementById('teacher').innerHTML = printUes(data.enseignant, data.total)
        })
    })
}
