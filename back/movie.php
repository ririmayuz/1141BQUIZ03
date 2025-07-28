<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<style>
    .movie {
        display: flex;
        width: 95%;
        height: 100px;
        margin: auto;
        box-shadow: 0 0 3px #999;
        align-items: center;
        padding: 2px;
        margin-bottom: 5px;
    }

    .movie>div:nth-child(1) {
        width: 10%;
    }

    .movie>div:nth-child(2) {
        width: 10%;
        /* height: 100px; */
    }

    .movie>div:nth-child(3) {
        width: 80%;
    }

    .movie>div:nth-child(3)>div:nth-child(1) {
        display: flex;
    }

    .movie>div:nth-child(3)>div:nth-child(1) div {
        width: 33%;
        /* height: 100px; */

    }
</style>
<div style="height:500px;overflow:auto;">
    <?php
    $movies = $Movie->all("order by `rank`");
    foreach ($movies as $idx => $movie):
        $prev = ($idx - 1 >= 0) ? $movies[$idx - 1]['id'] : $movie['id'];
        $next = ($idx + 1 < count($movies)) ? $movies[$idx + 1]['id'] : $movie['id'];
    ?>

        <div class="movie">
            <div>
                <img src="./image/<?= $movie['poster']; ?>" style="width: 60px; height: 80px; border: 2px solid #white;">
            </div>
            <div>
                分級: <img src="./icon/03C0<?= $movie['level']; ?>.png" style="width: 20px;">
            </div>
            <div>
                <div>
                    <div>片名:<?= $movie['name']; ?></div>
                    <div>片長:<?= $movie['length']; ?></div>
                    <div>上映時間:<?= $movie['ondate']; ?></div>
                </div>
                <div>
                    <button class='show-btn' data-id="<?= $movie['id'] ?>"><?= ($movie['sh'] == 1) ? '顯示' : '隱藏'; ?></button>
                    <button class="sw-btn" data-sw='<?= $prev; ?>' data-id="<?= $movie['id']; ?>">往上</button>
                    <button class="sw-btn" data-sw='<?= $next; ?>' data-id="<?= $movie['id']; ?>">往下</button>
                    <button>編輯電影</button>
                    <button class='del-btn' data-id="<?= $movie['id'] ?>">刪除電影</button>
                </div>
                <div>
                    劇情介紹:<?= $movie['intro']; ?>
                </div>
            </div>
        </div>

        <hr>
    <?php
    endforeach;
    ?>
</div>

<script>
    $(".show-btn").on("click", function() {
        let id = $(this).data("id");
        $.post("api/show_movie.php", {
            id
        }, () => {
            //location.reload();
            switch ($(this).text()) {
                case "顯示":
                    $(this).text("隱藏");
                    break;
                case "隱藏":
                    $(this).text("顯示");
                    break;
            }
        })
    })

    $(".sw-btn").on("click", function() {
        let id = $(this).data("id")
        let sw = $(this).data("sw")
        $.post("./api/sw.php", {
            table: 'Movie',
            id,
            sw
        }, (res) => {
            location.reload();
        })
    })

    // 監聽所有 class="del-btn" 的按鈕，當它被點擊時執行以下函式
    $(".del-btn").on("click", function() {

        // 取得當前被點擊按鈕的 data-id 屬性值
        // $(this) 代表當前被點擊的按鈕
        // .data("id") 會抓取 <button data-id="123"> 裡的 123
        let id = $(this).data("id");

        // 彈出確認視窗，詢問使用者是否確定要刪除
        if (confirm("確定刪除電影?")) {

            // 使用 jQuery 的 $.post 發送 AJAX 請求到後端 del.php
            // 傳送的資料是 {table:'Movie', id:id}
            // 當刪除完成後，執行回呼函式 (=> { location.reload(); })
            $.post("./api/del.php", {
                table: 'Movie',
                id
            }, () => {

                // 刪除成功後，重新整理頁面，讓最新資料顯示出來
                location.reload();
            })
        }
    });
</script>