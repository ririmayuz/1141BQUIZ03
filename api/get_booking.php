<style>
    .booking-box {
        width: 540px;
        height: 370px;
        background: url("./icon/03D04.png") no-repeat center;
        margin: auto;
    }

    .info-box {
        background: #ddd;
        width: 540px;
        margin: 10px auto;
        /* padding: calc(30%/2); */
        padding: 10px 70px;
        box-sizing: border-box;
    }

    #seats {
        display: flex;
        flex-wrap: wrap;/* 自動斷行 */
        width: 320px;
        height: 344px;
        margin: 0 auto;
        padding-top: 18px;
    }

    .seat{
        width: 64px;
        height: 86px;
        box-sizing: border-box;
        text-align: center;
        padding: 2px;
        /* background: #ddd; */
        /* opacity: 0.7; */
        position: relative;
    }

    .seat input[type="checkbox"] {
        position: absolute;
        bottom: 5px;
        right: 5px;
    }
    
    /* 對照格子用 */
    .seat:nth-child(odd){
        width: 64px;
        height: 86px;
        box-sizing: border-box;
        /* background: #eee; */
    }

    .booked {
        background: url("./icon/03D03.png") no-repeat center;
    }

    .null {
        background: url("./icon/03D02.png") no-repeat center;
    }
</style>

<div class="booking-box">
    <div id="seats">
        <?php
        for($i=0;$i<20;$i++):
            $booked='null';
        ?>
        <div class="seat <?=$booked;?>">
            <div>
                <?=floor($i/5)+1;?>排<?=($i%5)+1;?>號
            </div>
            <input type="checkbox" name="seat" value="<?$i;?>">
        </div>
        <?php
        endfor;
        ?>
    </div>
</div>
<!-- 1排1號 ->  -->
<!-- 1排2號 ->  -->
<!-- 1排3號 ->  -->
<!-- 1排4號 ->  -->
<!-- 1排5號 ->  -->

<div class="info-box">
    <div class="order-info">
        <div>您選擇的電影是：</div>
        <div>您選擇的時刻是：</div>
        <div>您已經勾選<span id="tickets">2</span>張票，最多可以購買四張票</div>
    </div>

    <div class="ct">
        <button class='btn-prev'>上一步</button>
        <button class='btn-order'>訂購</button>
    </div>
</div>