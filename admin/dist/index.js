function add_limit(event) {
    var btn = event.target;
    const plan = document.getElementById('limit_'+btn.id).textContent;
    $('#p_id').val(btn.id);
    $('#o_limit').text(plan);
	$('#exampleModal').modal('show');

}

function total_limit(){
    var o_value = parseInt($('#o_limit').text());
    var n_value = parseInt($('#n_limit').val());
    var t_value = n_value + o_value;
    $('#Total_new_limit').val(t_value);
    $('#Total_new_limit2').text(t_value);
   
}