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
    let no = 1;
    var datatable = document.getElementById('data');
    datatable.innerHTML = "";
    
    for(let i = 0; i < datasearch.length; i++) {
        const tr = document.createElement("tr");
        for(let y = 0; y < 5; y++) {
            const td = document.createElement("td");
            // td.textContent = no++;
            // td.innerHTML = datasearch[i]["users_id"];
            td.innerHTML = datasearch[i]["name"];
            // td.innerHTML = datasearch[i]["jurusan"];
            // td.appendChild(document.createElement("button"));
            tr.appendChild(td);
            datatable.appendChild(tr);
        }
    }
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