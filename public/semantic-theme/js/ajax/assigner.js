$(document).ready(function() {
    $("#assignForm").submit(function() {
        let token = $("input[name=_token]").val();
        let enseignant = $("input[name=enseignant_id]").val();
        let inputs = document
            .getElementById("area")
            .getElementsByTagName("input");
        let all = [];

        for (const input of inputs) {
            all.push(input.value)
        }
        const notifier = function(type,message){
          new Noty({
          type: type,
          layout: 'topRight',
          theme: 'semanticui',
          text: message,
          timeout: '6000',
          closeWith: ['click'],
          animation: {
                  open : 'animated fadeInRight',
                  close: 'animated fadeOutRight'
              }
          }).show();
        }
        const chunk = (arr, size) =>
            Array.from({
                    length: Math.ceil(arr.length / size)
                }, (v, i) =>
                arr.slice(i * size, i * size + size)
            );

        all = chunk(all, 4)

          $.ajax({
                  type: "POST",
                  url: "/home/assignations/new",
                  data: "data=" +
                      JSON.stringify(all) +
                      "&_token=" +
                      token +
                      "&enseignant_id=" +
                      enseignant,
                  dataType: 'JSON'
              })
              .done(function(reponse) {
                  if(reponse.success){
                    console.log(reponse.success);
                    // setTimeout(function () {
                    //   document.location.href = '/home/assignations/'
                    // }, 3000);
                  }else if (reponse.errors) {
                     const message = reponse.errors.join('\n')
                     notifier('error',message)
                  }
              })
              .fail(function(reponse) {
                 notifier('error','une erreure s\'est produite lors de la requette')
              });
         return false;
    });
});
