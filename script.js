var cari = document.getElementById('search');
cari.addEventListener('keypress', function() {
    if(cari.value.length > 2) {
        search(cari.value);
    }
});

function edit(user_id) {
    let username = document.querySelector("#tr_" + user_id + " .nama").innerText;
    let jurusan = document.querySelector("#tr_" + user_id + " .jurusan").getAttribute("id_jurusan");

    document.getElementById("username").value = username;
    document.getElementById("group-select").value = jurusan;
    document.getElementById("user-id").value = user_id;
}

function page(page,dataperpage) {
    let datatable = document.getElementById('table');
    let tr = "";
    let html = "";
    let no = (page * dataperpage) - (dataperpage - 1);

    fetch('controller.php?page=' + page).then(response => response.json()).then(response => {
        response.forEach((item) => {
                let click = 'onclick="edit(\'' + item.users_id + '\')"';
                let idtr = 'id="tr_' + item.users_id + '"';
                let id_jurusan = 'id_jurusan="' + item.student_groups_id + '"';
        
                html = "<tr " + idtr + "><td>" + (no++) + "</td><td>" + item.users_id + "</td><td class=\"nama\">" + item.name + "</td><td class=\"jurusan\" " + id_jurusan + ">" + item.jurusan + "</td><td><button " + click + ">Edit</button></td></tr>"
                tr = tr + html;
        
                datatable.innerHTML = tr;
        })
    });
}

function search(keyword) {
    fetch('controller.php', {
        method: 'POST',
        body: new URLSearchParams('keyword=' + keyword)
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
        let click = 'onclick="edit(\'' + item.users_id + '\')"';
        let idtr = 'id="tr_' + item.users_id + '"';
        let id_jurusan = 'id_jurusan="' + item.student_groups_id + '"';

        html = "<tr " + idtr + "><td>" + (no++) + "</td><td>" + item.users_id + "</td><td class=\"nama\">" + item.name + "</td><td class=\"jurusan\" " + id_jurusan + ">" + item.jurusan + "</td><td><button " + click + ">Edit</button></td></tr>"
        tr = tr + html;

        datatable.innerHTML = tr;
    })
}

function update() {
    let user_id = document.getElementById("user-id").value;
    let username = document.getElementById("username").value;
    let jurusan_id = document.getElementById("group-select").value;
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
