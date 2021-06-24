const previewLogo = function(e) {
    const target = e.target.id;
    const files = e.target.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];

        if (!file.type.startsWith('image/')) {
            continue
        }


        const thumbnail = document.getElementById("logoPreview");

        const reader = new FileReader();
        reader.onload = (function (athumbnail) {
            return function (e) {
                athumbnail.style.backgroundImage = `url(${e.target.result})`;
            };
        })(thumbnail);
        reader.readAsDataURL(file);

    }
}

const deleteMember = (ids)=>{
    $.ajax(`/dashboard/members`, {
        method: "DELETE",
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: JSON.stringify({ids: ids}),
        success: (response) => {
            ids.forEach((i) => {
                $(`#row-${i}`).remove();
            })
            $('#ajaxToast').toast('hide');
            showNotification(response.status, response.message);
        },
        error: (xhr, error, message) => {
            showNotification('error', xhr.responseJSON.message)
        },
        complete: ()=>{
            $("#confirmModal").modal('hide');
            $('#ajaxToast').toast('hide');
        }
    })
}

const addMember = ()=>{
    let formElem = $("#memberForm")[0]
    if (formElem.reportValidity()){
        let form = new FormData(formElem)

        $.ajax('/redcross/members/add.php', {
            method: 'POST',
            contentType: false,
            processData: false,
            dataType: "json",
            data: form,
            success: (response)=>{
                console.log(response)
            }
				})
		}
}	

const getUserDetails = ()=>{
    let userid = $("[type='checkbox']:checked").data('userid');
    $.ajax('details.php', {
            method: 'GET',
            contenttype: 'application/json; charset=utf-8',
            datatype: "json",
            data: `id=${userid}`,
            success: (response) => {
               if (response.status == 'success'){
                   let user = response.user;
                   let keys = Object.keys(user);
                    if (user['picture']){
                      $('#pictureBox').css('background-image', `url('/redcross/pictures/${user.picture}')`);
                      $('#pictureBox').css('background-size', 'cover');
                      $('#pictureBox').css('background-position', 'center');
                   }
                   else {
                      $('#pictureBox').css('background-image', '');
                   }

                   for (key of keys){
                      $(`[name='${key}']`).val(user[key]) 
                   }
                                  } 
            }
				})
}	

const generatePass = (pLength) =>{

    var keyListAlpha = "abcdefghijklmnopqrstuvwxyz",
        keyListInt = "123456789",
        keyListSpec = "!@#_",
        password = '';
    var len = Math.ceil(pLength / 2);
    len = len - 1;
    var lenSpec = pLength - 2 * len;

    for (i = 0; i < len; i++) {
        password += keyListAlpha.charAt(Math.floor(Math.random() * keyListAlpha.length));
        password += keyListInt.charAt(Math.floor(Math.random() * keyListInt.length));
    }

    for (i = 0; i < lenSpec; i++)
        password += keyListSpec.charAt(Math.floor(Math.random() * keyListSpec.length));

    password = password.split('').sort(function () {
        return 0.5 - Math.random()
    }).join('');

    $("[name='password']").val(password);
}

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
    $("input[type='radio']").on('click', (e)=>{
        if (e.target.id == 'yesAdmin'){
            $("#makeAdmin input[name='adminPassword']").removeClass('d-none');
            $("#makeAdmin input[name='adminPassword']").focus();
        }
        else if (e.target.id == 'noAdmin'){
            $("#makeAdmin input[name='adminPassword']").addClass('d-none');
        }
    })

    $('#userDetailsTool').on('click', (e) => {
        getUserDetails()
        $(".modal-title-text").text('Update Member Info');
        $("#userModal [type='submit'] span").text('Update');
        $("#userModal [type='submit'] i").removeClass('fa-user-plus').addClass('fa-save')
    })

    $('#userAddTool').on('click', e=>{
        document.getElementById('userForm').reset();
        $('#pictureBox').css('background-image', '');
        $(".modal-title-text").text('Registration Form');
        $("#userModal [type='submit'] span").text('Submit');
        $("#userModal [type='submit'] i").removeClass('fa-save').addClass('fa-user-plus')
    })
})
