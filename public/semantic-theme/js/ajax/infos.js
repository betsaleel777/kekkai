function infos() {
    const array_sum = function(array) {
        let key
        let sum = 0
        // input sanitation
        if (typeof array !== 'object') {
            return null
        }
        for (key in array) {
            if (!isNaN(parseFloat(array[key]))) {
                sum += parseFloat(array[key])
            }
        }
        return sum
    }
    const checkRepeat = function(key, liste) {
        let cm= [], td = [] ,tp = []
        data = {
            cm: null,
            td: null,
            tp: null
        }
        for (let i = 0, c = liste.length, j = 0; i < c; i++) {
            if (liste[i].libelle === key) {
                cm.push(liste[i].pivot.cm)
                td.push(liste[i].pivot.td)
                tp.push(liste[i].pivot.tp)
            }
        }
        data.cm = array_sum(cm)
        data.td = array_sum(td)
        data.tp = array_sum(tp)
        return data
    }
    const parcours = function(iterable) {
        calebasse = ''
        for (ue of iterable) {
            let {libelle,...rest} = ue
            pivot = checkRepeat(libelle, iterable)
            calebasse += `<tr><td>${libelle}</td>
                      <td>${pivot.cm}</td>
                      <td>${pivot.td}</td>
                      <td>${pivot.tp}</td></tr>`

        }
        return calebasse
    }
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
            document.getElementById('teacher').innerHTML = printUes(data.enseignant.ues, data.total)
        })
    })
}
