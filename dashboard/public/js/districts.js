$(()=>{
  let registrationForm = $("#registration");
  registrationForm.on('submit', (e)=>{
    e.preventDefault();
    console.log($(e.currentTarget))
  })
    $("input[type='checkbox']").on('click', (e)=>{
        let checkAll = $(e.target);
        if (e.target.id == 'checkAll'){
            if (checkAll.is(':checked')){
                $("input[type='checkbox']").prop('checked', true)
                $(".tool-delete").removeClass('disabled');
            }
            else {
                $("input[type='checkbox']").prop('checked', false)
                $(".select-tool").addClass('disabled');
            }
        }
        else {
            if ($(e.target).is(':checked'))
                $(".select-tool").removeClass('disabled');
            else
                $(".select-tool").addClass('disabled')
        }
        
    })
})
