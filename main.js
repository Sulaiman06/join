function edit(user_id) {
    let username = document.querySelector("#tr_" + user_id + " .nama").innerText;
    let jurusan = document.querySelector("#tr_" + user_id + " .jurusan").getAttribute("id_jurusan");

    document.getElementById("username").value = username;
    document.getElementById("group-select").value = jurusan;
    document.getElementById("user-id").value = user_id;
}

function search() {
    var search = document.getElementById('search').value;

    fetch('controller.php', {
        method: 'POST',
        body: new URLSearchParams('keyword=' + search)
    })
    .then(response => response.json())
    .then(response => searchdata(response));
}

function searchdata(datasearch) {
    let datatable = document.getElementById('table');
    let tr = "";
    let html = "";
    let no = 1;

    datasearch.forEach((item) => {
        let click = 'onclick="edit(\'' + item.users_id + '\',\'' + item.name + '\',\'' + item.student_groups_id + '\')"';

        html = "<tr><td>" + (no++) + "</td><td>" + item.users_id + "</td><td>" + item.name + "</td><td>" + item.jurusan + "</td><td><button " + click + ">Edit</button></td></tr>"
        tr = tr + html;

        datatable.innerHTML = tr;
    })
}

function update() {
    let username = document.getElementById("username").value;
    let jurusan_id = document.getElementById("group-select").value;
    let user_id = document.getElementById("user-id").value;
    let jurusan = document.querySelector("#group-select option[value='" + jurusan_id + "']").innerText;

    fetch('controller.php?user_id=' + user_id + '&user=' + username + '&jurusan_id=' + jurusan_id + '&func=update')
    .then(response => {
        if (response.ok) {
            document.querySelector("#tr_" + user_id + " .nama").innerHTML = username;
            document.querySelector("#tr_" + user_id + " .jurusan").innerHTML = jurusan;
            document.querySelector("#tr_" + user_id + " .jurusan").setAttribute("id_jurusan", jurusan_id);
        }
    });
}


// !redeem creeper 