<template>
    <v-card :loading="tableLoading">
        <v-card-title>Продукты</v-card-title>
        <v-form @submit.prevent="searchButton">
            <v-container>
                <v-row>
                    <v-col v-for="field in filterForm"
                           cols="3"
                    >
                        <v-text-field
                            clearable
                            v-model.trim="field.value"
                            :label="field.label"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-btn :loading="tableLoading" type="submit" block class="mt-2">Поиск</v-btn>
            </v-container>
        </v-form>

        <v-table fixed-header height="400px">
            <thead>
            <tr>
                <th class="text-left">
                    Наименование
                </th>
                <th class="text-left">
                    Код
                </th>
                <th class="text-left">
                    Цвет
                </th>
                <th class="text-left">
                    Цена
                </th>
                <th class="text-left">
                    Размер
                </th>
                <th class="text-left">
                    Описание
                </th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="item in tableData"
                :key="item.id"
            >
                <td>{{ item.name }}</td>
                <td>{{ item.code }}</td>
                <td>{{ item.color }}</td>
                <td>{{ item.price }}</td>
                <td>{{ item.size }}</td>
                <td>{{ item.description }}</td>
            </tr>
            </tbody>
        </v-table>
    </v-card>
</template>

<script setup>
import {ref} from "vue";

const tableData = ref([]);
const tableLoading = ref()
const filterForm = ref(
    {
        name: {label: 'Имя', value: null},
        code: {label: 'Код', value: null},
        color: {label: 'Цвет', value: null},
        min_price: {label: 'Минимальная или точная цена', value: null},
        max_price: {label: 'Максимальная цена', value: null},
        size: {label: 'Размер', value: null},
        description: {label: 'Описание', value: null}
    }
);

const getData = (params=null) => {
    tableLoading.value=true
    axios.get('/data', {params})
        .then(res => {
            tableData.value = res.data.data
            console.log('tableData', tableData.value);
        })
        .catch(err=>{
            console.error(err)
        })
        .finally(() => {
            tableLoading.value = false
        })
}
const searchButton=()=>{
    console.log('filterForm',filterForm.value);
    const arr=Object.entries(filterForm.value)
        .filter(([_, value])=>!!value.value)
        .map(([key, value])=>([key,value.value]))
    const obj=Object.fromEntries(arr)
    console.log('obj',obj);
    getData(obj)
}
getData()
</script>

<style scoped>

</style>
