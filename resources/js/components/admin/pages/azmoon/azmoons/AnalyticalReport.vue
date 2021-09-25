<template>
    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">گزارش تحلیل </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">نتایج آزمون</li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                    <div class="col-md-8">
            <div class="float-right ">
              <router-link :to="{name : 'AzmoonShow',params: { id: this.$route.params.id },}" class="btn btn-light btn-rounded btn-sm">
                <i class="dripicons-arrow-left mr-1"></i>
                <strong>برگشت</strong>
              </router-link>
            </div>
          </div>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">مشاهده جزئیات آزمون</h4>
                                <div class="" v-for="last in last_data" :key="last.id">

                                    <div class="table-responsive mb-5" >
                                        <table class="table mb-0">
                                            <thead>
                                            <tr >
                                                <th class="text-center" colspan="11"><span class="font-size-20">{{ last.book_name }}</span></th>
                                            </tr>
                                            <tr>
                                                <th>سوال </th>
                                                <th>کلید</th>
                                                <th> درست</th>
                                                <th> غلط</th>
                                                <th> گزینه 1</th>
                                                <th>گزینه 2</th>
                                                <th> گزینه 3</th>
                                                <th> گزینه 4</th>
                                                <th> نزده</th>
                                                <th> درصد</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="list in last.results" :key="list.id">
                                                <td>{{ list.soalNumber }}</td>
                                                <td>{{ list.soalKey }}</td>
                                                <td>{{ list.correctCount }}</td>
                                                <td>{{ list.incorrectCount }}</td>
                                                <td>{{ list.optionACount }}</td>
                                                <td>{{ list.optionBCount }}</td>
                                                <td>{{ list.optionCCount }}</td>
                                                <td>{{ list.optionDCount }}</td>
                                                <td>{{ calcTotalUncheckedCount(list.uncheckedCount) }} </td>
                                                <td>{{ calcPercent(list.correctCount,list.soalNumber) }} <span>درصد</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div>
                                            <h3>نمودار سوال</h3>
                                            <GChart
                                                type="PieChart"
                                                :data="chartData"
                                                :options="options"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { GChart } from 'vue-google-charts'

    export default {

        name: "AnalyticalReport",


        data(){
            return{
                last_data:[],
                lists:[],
                studentCount:0,
                testedCount:0,
                untestedCount:0,

                chartData: [
                    ["Language", "Blog"],
                ],
                options: {
                    'title': 'Data Line',
                    'height':300
                },

                first_num:0,


            }
        },

        methods:{
            fetchAzmoonAnalyticalReport(azmoonId){
                Vue.http.get('api/admin/azmoon/analytical-report/'+azmoonId).then(response=>{
                    //console.log(response.body);
                    this.last_data=response.body.last_data;
                    this.lists=response.body.lists;
                    this.studentCount=response.body.studentCount;
                    this.testedCount=response.body.testedCount;
                }).catch(error=>{
                    console.log(error);
                })
            },

            calcPercent(correctCount,soalNumber){
                let res = (correctCount / this.studentCount ) * 100;
               let percentData = parseFloat(res).toFixed(2);
               if (this.first_num < soalNumber){
                   this.first_num = soalNumber;
                   let soal = "سوال " + soalNumber;
                   this.chartData.push([soal,res]);
                   console.log( this.chartData)
               }
               return percentData;
            },

            calcUntestedCount(){
                this.untestedCount = this.studentCount - this.testedCount;
            },

            calcTotalUncheckedCount(uncheckedCount){
                return this.untestedCount + uncheckedCount;
            },


        },

        created() {
            this.fetchAzmoonAnalyticalReport(this.$route.params.id);
        },

        async mounted() {


        },
        updated() {
            this.calcUntestedCount();
        },

        components: {
            GChart
        }

    }
</script>

<style scoped>

</style>
