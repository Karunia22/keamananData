function renderCharts() {

    var dataCharts = window.dataCharts || [];

    for (let i = 0; i < dataCharts.length; i++) {

        var canvas = document.getElementById('tiketChart' + (i + 1));
        if (!canvas) continue;

        var ctx = canvas.getContext('2d');

        let close = dataCharts[i].close || 0;
        let belum = dataCharts[i].belum || 0;

        let semuaNol = (close + belum) === 0;

        let labels, data, colors;

        if (semuaNol) {
            labels = ['Tidak Ada Data'];
            data = [1];
            colors = ['rgb(150,150,150)'];
        } else {
            labels = ['Close', 'Belum Close'];
            data = [close, belum];
            colors = ['#00c66a', '#da3d11'];
        }

        new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    hoverOffset: 10
                }]
            },
        });
    }
}
