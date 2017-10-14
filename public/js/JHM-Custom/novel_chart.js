// Any of the following formats may be used

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'polarArea',
    data: {
        labels: ["武侠", "ロマンス", "ファンタジー", "ホラー", "推理", "SF"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(48, 48, 48, 1)',
                'rgba(255, 156, 156, 1)',
                'rgba(169, 201, 68, 1)',
                'rgba(201, 0, 40, 1)',
                'rgba(201, 202, 202, 1)',
                'rgba(46, 226, 227, 1)'
            ],
            borderColor: [
                'rgba(48, 48, 48, 1)',
                'rgba(255, 156, 156, 1)',
                'rgba(169, 201, 68, 1)',
                'rgba(201, 0, 40, 1)',
                'rgba(201, 202, 202, 1)',
                'rgba(46, 226, 227, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        animation: {
            animateRotate: true,
            animateScale: true
        }
    }
});


