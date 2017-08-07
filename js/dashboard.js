
function accept_deny(i,c)
{
    var message = $("#message_"+i).val();

    var xhttp = new XMLHttpRequest();

    //Ajax Request
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            $("#action_"+i).fadeOut();

             document.getElementById("actor_"+i).innerHTML = xhttp.responseText;
            console.log(xhttp.responseText);
        }
      };
      xhttp.open("GET", "accept_reject.php?act="+c + "&msg=" + message + "&id=" + i, true);
      xhttp.send();

    $("#action_"+i).fadeOut();

}

function sf(){
    var emailFilter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
    var reciever=$("#reciever").val();
    if (!emailFilter.test(reciever)) {
        //console.log(reciever);
        Materialize.toast('Please enter a valid e-mail address.', 4000)
        return false;
    }

    var item = ["",$("#item_1").val(), $("#item_2").val(), $("#item_3").val(), $("#item_4").val(), $("#item_5").val()];
    var cost = ["",$("#cost_1").val(), $("#cost_2").val(), $("#cost_3").val(), $("#cost_4").val(), $("#cost_5").val()];
    var quantity = ["",$("#quantity_1").val(), $("#quantity_2").val(), $("#quantity_3").val(), $("#quantity_4").val(), $("#quantity_5").val()];
    var discount = ["",$("#discount_1").val(), $("#discount_2").val(), $("#discount_3").val(), $("#discount_4").val(), $("#discount_5").val()];

    var i = 1 ;
    for(i = 1 ; i<=5; i++)
    {
        // Form data validation
        if(item[i].length != 0){

            if( item[i].length >50){
            Materialize.toast("Please enter a valid item " + i + " name.", 4000);
            return false;
            }

            if(isNaN(cost[i]) || cost[i].length==0)
            {
                console.log(parseFloat(cost[i]));
                Materialize.toast("Please enter a valid item " + i + " cost.", 4000);
                return false;
            }

            if(parseFloat(cost[i])>10000 || parseFloat(cost[i])<1)
            {
                console.log(parseFloat(cost[i]));
                Materialize.toast("Item " + i + " cost out of range. (1 to 10,000)", 4000);
                return false;
            }

            if(isNaN(quantity[i]) || quantity[i].length == 0)
            {
                console.log(parseFloat(quantity[i]));
                Materialize.toast("Please enter a valid item " + i + " quantity.", 4000);
                return false;
            }

            if(parseFloat(quantity[i])>1000 || parseFloat(quantity[i])<1)
            {
                console.log(parseFloat(quantity[i]));
                Materialize.toast("Item " + i + " quantity out of range. (1 to 1,000)", 4000);
                return false;
            }

            if(isNaN(discount[i]) || discount[i].length == 0)
            {
                console.log(parseFloat(discount[i]));
                Materialize.toast("Please enter a valid item " + i + " discount.", 4000);
                return false;
            }

            if(parseFloat(discount[i])>100 || parseFloat(discount[i])<0)
            {
                console.log(parseFloat(discount[i]));
                Materialize.toast("Item " + i + " discount out of range.(0 to 100)", 4000);
                return false;
            }

        }



    }

    //console.log("1");

    var postForm = {
        'item_1' : item[1], 'item_2' : item[2], 'item_3' : item[3], 'item_4' : item[4], 'item_5' : item[5],
        'cost_1' : cost[1], 'cost_2' : cost[2], 'cost_3' : cost[3], 'cost_4' : cost[4], 'cost_5' : cost[5],
        'quantity_1' : quantity[1], 'quantity_2' : quantity[2], 'quantity_3' : quantity[3], 'quantity_4' : quantity[4], 'quantity_5' : quantity[5],
        'discount_1' : discount[1], 'discount_2' : discount[2], 'discount_3' : discount[3], 'discount_4' : discount[4], 'discount_5' : discount[5],
        'reciever': reciever

    };

    //Ajax Request POST METHOD
    $.ajax({ //Process the form using $.ajax()
        type      : 'POST', //Method type
        url       : 'submit_invoice.php', //file URL
        data      :  postForm, //data to send

        success   : function(data) {
                        Materialize.toast(data, 4000);
                        //console.log(data);
                        }
    });

}
