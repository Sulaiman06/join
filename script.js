function edit(user_id,username,jurusan_id) {
    document.getElementById("username").value = username;
    document.getElementById("group-select").value = jurusan_id;
    document.getElementById("user-id").value = user_id;
}

function update() {
    var username = document.getElementById("username").value
    var jurusan_id = document.getElementById("group-select").value
    var user_id = document.getElementById("user-id").value

    fetch('controller.php?user_id=' + user_id + '&user=' + username + '&jurusan_id=' + jurusan_id + '&func=update').then(response => {
        if (response.ok) {
            alert('success');
            document.getElementById('user').value=username;
            document.getElementById('jurusan').value=jurusan_id;
        }
    });
}