function f1_scrape_info_drivers(id, url) {

        fetch(`http://localhost:63342/DB.php/controllers/Drivers/info_drivers.php?url=${encodeURIComponent(url)}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data) {
                    let info = ["Team", "Country", "Podiums", "Points", "Grands Prix entered", "World Championships",
                        "Highest race finish", "Highest grid position", "Date of birth", "Place of birth"];
                    let tmp = "";
                    for(let i=0; i<data.length; i++){
                        tmp += `<li><strong>${info[i]}: </strong>${data[i]}</li>`
                    }
                    const info_html = `<div class="card-body d-flex align-items-center">
                                <div class="w-100">
                                <ul>`+
                                tmp
                                +`</ul>
                                <hr style="position: relative; top:128px">
                                <button style="position: relative; top:128px" type="button" onclick="show_driver(${id})" class="card-link text-decoration-none d-flex flex-row justify-content-end">
                                <span class="my_outline_animation d-flex flex-row gap-2 pb-1 hover-red">
                                    <span class="material-symbols-outlined">keyboard_double_arrow_right</span>
                                    More info
                                    <span class="material-symbols-outlined">sports_score</span>
                                </span>
                                </button>
                        </div>
                    </div>`

                    console.log(info_html);
                    $(`#num${id}`).addClass('d-none');
                    $(`#info_driver${id}`).removeClass('d-none').html(info_html);
                    }
            })
            .catch(error => {
                console.error('Error in API call:', error);
            });
}