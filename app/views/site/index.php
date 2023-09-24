<?php
/** @var yii\web\View $this */
$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Расчет стоимости доставки</h1>
        <p class="lead">Выберите место отправления и доставки, а также введите вес отправления</p>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12 mb-10">
                <form id="main_form">
                    <div class="col-lg-3">
                        <input id="from" placeholder="КЛАДР отправления"/>
                        <input id="to" placeholder="КЛАДР назначения"/>
                        <input id="weight" placeholder="Вес"/>
                        Быстрая доставка: <input id="fast" type="checkbox"/><br />
                        <button class="send" type="button">Стоимость</button>
                    </div>
                </form>
                <div class="col-lg-12">
                    <table class="main">
                        <thead>
                            <tr>
                                <th>Компания</th>
                                <th>Стоимость</th>
                                <th>Дата доставки</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('button.send').on('click', function () {
            $('.error').removeClass('error');
            if (!$('#from').val()) {
                $('#from').addClass('error');
                $('#from').focus();
                return;
            }
            if (!$('#to').val()) {
                $('#to').addClass('error');
                $('#to').focus();
                return;
            }
            if (!$('#weight').val()) {
                $('#weight').addClass('error');
                $('#weight').focus();
                return;
            }
            let url = '/price/';
            if ($('#fast:checked').length > 0) {
                url += '?fast';
            }
            $.post(
                    url,
                    {
                        from: $('#from').val(),
                        to: $('#to').val(),
                        weight: $('#weight').val()
                    },
                    function (data) {
                        $('table.main tbody').empty();
                        for (let i = 0; i < data.length; i++) {
                            let append = '<tr>' +
                                    '<td>' + data[i].company + '</td>' +
                                    '<td>' + data[i].price + '</td>' +
                                    '<td>' + data[i].date + '</td>' +
                                    '</tr>';
                            $('table.main tbody').append(append);
                        }
                    },
                    'json'
                    );
        });
    });
</script>
