<template>
    <h1>Soal 1</h1>
    <input type="number" v-model="input" />
    <ul>
        <li v-for="item in itemList" :key="item">
            {{ generatePattern(item) }}
        </li>
    </ul>
</template>

<script setup>
import { ref, computed } from "vue";
let input = ref(0);

// generate array to use in v-for
const itemList = computed(() => {
    return Array.from({ length: input.value }, (_, index) => index + 1);
});

const generatePattern = (num) => {
    let result = "";
    // set the start of index which the number would be replaced by asterisk
    let asteriskStart = num + 1;
    // input value is added 3 for the length
    for (let i = 1; i <= input.value + 3; i++) {
        // if the index is equal the index of the current asteriskStart or current asteriskStart+1
        if (i == asteriskStart || i == asteriskStart + 1) {
            result += "*";
        } else {
            result += i;
        }
    }
    return result;
};
</script>
