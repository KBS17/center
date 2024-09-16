<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Div Notification</title>
</head>

<!-- <style>
    .notify {
        position: relative;
    }

    .notify-btn {
        margin-right: 100px;
        margin-top: 300px;
        float: right;

    }

    .notify-menu {
        overflow: hidden;
        box-shadow: 1px 1px 10px rgba(0, 0, 0, .2);
        position: absolute;
        width: 200px;
        top: 140px;
        right: 130px;
        display: none;
    }

    .show{
        display:block;
    }

    .notify-menu li {
        padding: 1rem;
        font-size: 1.1rem;
        width: 100%;
        list-style: none;
    }


    .notify-menu li:hover {
        background-color: #ccc;
        cursor: pointer;
        color: white;
    }


    .icon-button {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        color:#333333;
        background:#dddddd;
        border: none;
        outline: none;
        border-radius: 50%;
    }

    .icon-button {
        cursor: pointer;
    }

    .icon-button:active {
        background:#cccccc;
    }


    .icon-button_badge {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 25px;
        height: 25px;
        background:red;
        color:#ffffff
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
    }

</style> -->

<body>

    <!-- notification div -->
    <div class="notify">
        <div dlass="notify-btn" id="notify-btn">
            <!-- notification button -->

            <button type="button" class="icon-button">
                 <span><img src="notification.png" width="30" height="30"></span>
                 <span class="icon-button __ badge" id="show_notif">0</span>
            </button>
    
        </div>
    
        <!-- notification drop down menu -->
        <div class="notify-menu" id="notify-menu">
             <!-- message will be show here -->
        </div>
    </div>

    <script>
        const notify_btn = document.getElementById('notify-btn');
        const notify_label = document.getElementById('show_notif');
        const notify_container = document.getElementById('notify-menu');


        let xhr = new XMLHttpRequest();

        function notify_me() {
            xhr.open('GET', 'select.php', true);

            xhr.send();

            xhr.onload = ()=>{
                if (xhr.status == 200){
                    let get_data = JSON.parse(xhr.responseText);

             
                    if (get_data == get_data) {
                        notify_label.innerHTML = get_data;
                    } else {
                        notify_btn.innerHTML += get_data;
                    }

                    
                }
            }
        }

        window.onload = () => {
            notify_me();

            setInterval(() => {
                notify_me();
            },1000)
        }

        notify_btn.addEventListener('click', (e)=>{
            e.preventDefault();


            notify_container.classList.toggle('show');
            
            xhr.onload('GET', 'data.php', true);

            xhr.send();

            notify_container.innerHTML = '';
            xhr.onload = function() {
                if (xhr.status == 200) {
                    let data = JSON.parse(xhr.responseText);

                    data.forEach(notify => {
                        let li = <li>${notify.$noti}</li>;

                        notify_container.innerHTML += li;

                    });
                }
            }
        })


    </script>
    
</body>
    
</html>








