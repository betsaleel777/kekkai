function verify(input){
    const ue = input.getAttribute('ue').trim()
    const name = input.getAttribute('name')
    const test = input.value.trim()
    const field = input.parentElement.parentElement
    const url = function() {
        return '/home/verify/' + name
    }
    button = document.getElementById('button')

    const thunder = function(){
      messagesCollection = document.getElementsByClassName("extra content")
      if(button.getAttribute('disabled')){
        button.removeAttribute('disabled')
      }
      // console.log(messagesCollection)
      for (messageElement of messagesCollection) {
        if(messageElement.firstElementChild){
          if(messageElement.firstElementChild.className === 'red exclamation circle icon'){
            button.setAttribute('disabled','disabled')
            break
          }
        }
      }
    }

    if (test) {
        const token = document.querySelector('input[name="_token"]').value
        fetch(url(), {
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
                space = field.getElementsByClassName("extra content")[0]
                space.removeAttribute('hidden')
                if (data.error) {
                    space.innerHTML = `<i class='red exclamation circle icon'></i><span style='color:red'>${data.error}</span>`
                    thunder()
                } else if (data.message) {
                    space.innerHTML = `<i class='green check circle icon'></i><span style='color:green'>${data.message}</span>`
                    thunder()
                }
            })
        })
    }
}
