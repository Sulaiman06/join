function edit(user_id,username,jurusan_id) {
    document.getElementById("username").value = username;
    document.getElementById("group-select").value = jurusan_id;
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
    var datatable = document.getElementById('data');
    datatable.innerHTML = "";

    // for(let i = 1; i <= datasearch.length; i++) {
    //     let number = datatable.insertRow();
    //     let number1 = number.insertCell();
    //     number1.textContent = i;
    // }

    datasearch.forEach((item) => {
        let no = 1
        let tr = datatable.insertRow();
        let nomor = tr.insertCell();
        
        for(let i = 1; i <= datasearch.length; i++) {
            nomor.textContent = i;
        }

        for(const key in item) {
            let cell = tr.insertCell();
            cell.textContent = item[key];
        }
    })
}

function update() {
    var username = document.getElementById("username").value;
    var jurusan_id = document.getElementById("group-select").value;
    var user_id = document.getElementById("user-id").value;

    fetch('controller.php?user_id=' + user_id + '&user=' + username + '&jurusan_id=' + jurusan_id + '&func=update').then(response => {
        if (response.ok) {
            // document.getElementById("name").reload;
        }
    });
}


// !redeem creeper 