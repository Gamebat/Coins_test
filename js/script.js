
for (let i in javascript_array) {
    document.getElementById('btn'+javascript_array[i]).innerHTML = 'Уже использовано';
    document.getElementById('btn'+javascript_array[i]).className += ' used';
    document.getElementById('btn'+javascript_array[i]).disabled = true; 
}
console.log("Первый элемент", javascript_array[0]);

function test(id){
    console.log('asd '+id);
}

function DoAction(id)
{
    $.ajax({
         type: "POST",
         url: "productBuy.php",
         data: id,
         success: function(data){
                     alert( "Data Saved: " + data );
                  }
    });
}