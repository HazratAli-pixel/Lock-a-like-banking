function copy_link(event) {
    var btn = event.target;
    const link = document.getElementById('link_'+btn.id);
    link.select();
    link.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(link.value);

}

// function total_limit(){
//     var o_value = parseInt($('#o_limit').text());
//     var n_value = parseInt($('#n_limit').val());
//     var t_value = n_value + o_value;
//     $('#Total_new_limit').val(t_value);
//     $('#Total_new_limit2').text(t_value);
   
// }