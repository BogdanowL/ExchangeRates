<template>
            <div class="col-lg-12">
                <div v-if="loading || error" class="error">
                    <div class="alert alert-danger" role="alert">
                      <h1 class="text-center" v-if="loading">Загрузка</h1>
                      <h1 class="text-center" v-if="error">Ошибка {{error}}</h1>
                    </div>
                </div>
            </div>
    <button class="btn btn-success btn-lg mt-4 mb-4" v-on:click="fetchData"> Обновить</button>

    <div class="row">
        <div class="col-md-6">
            <select v-model="valute" name="valute[]" class="form-select form-select-lg mb-4"  multiple>
                <option v-for="currencyName in currencies" :value="currencyName" :id="currencyName.id">{{currencyName}}</option>
            </select>
            <div class="mb-3">
                <span class="h4 ">Выбрано: {{valute}}</span>
            </div>

            <button class="btn btn-success btn-lg mt-4 mb-4" v-on:click="sampleRates(valute)"> Запрос по выбранным валютам</button>

        </div>
        <div class="col-md-6">
            <h2>Установить интервал обновления в секундах</h2>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <input v-model="interlal" type="text" id="interval" class="form-control" >
                </div>
                <div class="col-auto">

        <button class="btn btn-success btn-lg mt-4 mb-4" v-on:click="setUpdate(interlal)"> Задать интервал</button>
                </div>
            </div>
        </div>
    </div>
                <table class="table mt-3">
                    <thead>
                    <tr>
                        <th scope="col">#ID Валюты</th>
                        <th scope="col">NumCode</th>
                        <th scope="col">Валюта</th>
                        <th scope="col">Номинал</th>
                        <th scope="col">Название</th>
                        <th scope="col">Курс RUB</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="currency in rates" >
                        <th scope="row">{{ currency.currencyId }}</th>
                        <td> {{ currency.numCode }}</td>
                        <td> <strong>{{ currency.charCode }}</strong> </td>
                        <td>{{ currency.nominal }}</td>
                        <td> {{ currency.name }}</td>


                        <td v-if="currency.vibration[0]"  >
                        {{ currency.value }} &nbsp; <i class="bi bi-arrow-down" style="color: red">Падение на {{currency.vibration[0]}}</i>
                        </td>

                        <td v-if="currency.vibration[1]"  >
                        {{ currency.value }} &nbsp; <i class="bi bi-arrow-up" style="color: green">Повышение на {{currency.vibration[1]}}</i>
                        </td>
                    </tr>
                    </tbody>
                </table>
</template>

<script>
import axios from 'axios';

export default {
    props: ['currencies'],
    data() {
        return {
            loading: false,
            rates: null,
            error: null,
            timing: null,
            interlal: null,
            valute: [],
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        setUpdate(interval){
            const seconds = parseInt(interval + '000') ;

            clearInterval(this.timing);
            this.timing = setInterval(this.fetchData, seconds)
        },
        sampleRates(values){
            const request = {
                rates: [values],
            };
            this.error = this.rates = null;
            this.loading = true;
            axios
                .post('/api/rates/', request)
                .then(response => {
                    this.loading = false;
                    console.log(response.data)
                    this.rates = response.data;
                }).catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
            }).finally(
                this.valute = []
            );
        },
        fetchData() {
            this.error = this.rates = null;
            this.loading = true;
            axios
                .get('/api/rates')
                .then(response => {
                    this.loading = false;
                    this.rates = response.data;
                }).catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
            });
        },
    },
    beforeDestroy() {
        clearInterval(this.timing);
    }
}
</script>
