// API
fetch("/api/wallet")
    .then((response) => response.json())
    .then((data) => {
        let money_in = data.money_in;
        let money_out = data.money_out;

        // Line Chart
        const lineChart = document.getElementById("lineChart");
        const date = new Date();
        const month = date.getMonth();

        const months = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mai",
            "Juni",
            "July",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];

        // Month
        let startMonthIndex, endMonthIndex;
        if (month <= 5) {
            startMonthIndex = 0;
            endMonthIndex = 5;
        } else {
            startMonthIndex = 6;
            endMonthIndex = 11;
        }

        const selectedMonth = months.slice(startMonthIndex, endMonthIndex + 1);
        const moneys_in = money_in
            .flat()
            .slice(startMonthIndex, endMonthIndex + 1);
        const moneys_out = money_out
            .flat()
            .slice(startMonthIndex, endMonthIndex + 1);

        if (lineChart) {
            new Chart(lineChart, {
                type: "line",
                data: {
                    labels: selectedMonth,
                    datasets: [
                        {
                            label: "Pemasukan",
                            data: moneys_in,
                            borderWidth: 1,
                        },
                        {
                            label: "Pengeluaran",
                            data: moneys_out,
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: "Riwayat Perbulan",
                            align: "start",
                        },
                    },
                },
            });
        }
    });
