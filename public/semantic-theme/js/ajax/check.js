//utilise l'id de l'ue choisit et verifie si la valeur d'heure du cm , du td ou du tp
//est logique c'est a dire ne depasse pas la valeur maximale à assigner

function check(input) {
    const name = input.getAttribute('name')
    const test = input.value
    const ue = document.getElementById('ue').getElementsByTagName('input')[0].value
    const token = document.querySelector('input[name="_token"]').value
    const url = '/home/verify/'+name
    let button = document.getElementById('button')

    // const thunder = function(){
    //   messagesCollection = document.getElementsByClassName("extra content")
    //   if(button.getAttribute('disabled')){
    //     button.removeAttribute('disabled')
    //   }
    //   // console.log(messagesCollection)
    //   for (messageElement of messagesCollection) {
    //     if(messageElement.firstElementChild){
    //       if(messageElement.firstElementChild.className === 'red exclamation circle icon'){
    //         button.setAttribute('disabled','disabled')
    //         break
    //       }
    //     }
    //   }
    // }

    if (test) {
        fetch(url, {
            method: 'post',
            credentials: "same-origin",
            headers: {
                'Content-type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                ue,
                test
            })
        }).then((response) => {
            response.json().then((data) => {
                space = document.getElementById(`${name}_content`)
                if (data.error) {
                    console.log(data.error)
                    space.innerHTML = `<i class='red exclamation circle icon'></i><span style='color:red'>${data.error}</span>`
                    // thunder()
                } else if (data.message) {
                    console.log(data.message)
                    space.innerHTML = `<i class='green check circle icon'></i><span style='color:green'>${data.message}</span>`
                    // thunder()
                }
            })
        })
    }
}
