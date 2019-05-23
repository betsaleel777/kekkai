function infos() {
    const parcours = function(iterable) {
      calebasse = ''
      for (ue of iterable) {
        calebasse += `<tr><td>${ue.libelle}</td>
                      <td>${ue.pivot.cm}</td>
                      <td>${ue.pivot.td}</td>
                      <td>${ue.pivot.tp}</td></tr>`

      }
      return calebasse
    }
    const printUes = function(ues,total) {
        return `<div class="nine wide column">
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
            document.getElementById('teacher').innerHTML = printUes(data.enseignant.ues,data.total)
        })
    })
}
