<template>
    <div>
        <chart-doughnut :chart-data="chartData"></chart-doughnut>
    </div>
</template>

<script>
    import ChartDoughnutBase from "../../../services/component/ChartDoughnutBase";

    export default {
        name: "ChartDoughnut",
        components: {
            'chart-doughnut':ChartDoughnutBase
        },
        data() {
            return {
                chartData: null
            };
        },
        mounted() {
            this.fillData();
        },
        methods: {
            fillData() {
                this.chartData = {
                    labels: ["Foo", "Bar", "Baz"],
                    datasets: [
                        {
                            backgroundColor: ["#f36e60", "#ffdb3b", "#185190"],
                            hoverBackgroundColor: ["#fbd2cd", "#fef5c9", "#d1e3f7"],
                            data: [10, 20, 40]
                        }
                    ]
                };
            }
        }
    }
</script>


