<script setup>

import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    groupId: {
        type: Number,
        required: true
    },
    groupName: {
        type: String,
        required: true
    },
    groupRules: {
        type: Array,
        required: true
    },
    taxRules: {
        type: Object,
        required: true
    },
})

console.log(props)

const form = useForm({
    name: props.groupName,
    rules: props.groupRules,
})
var selectedRuleId = 0;

function addRule() {
    if (selectedRuleId) {
      let ruleId = parseInt(selectedRuleId)
      if (ruleId == 0) {
        return
    }
      if (form.rules.indexOf(ruleId) === -1) {
        form.rules.push(ruleId)
        selectedRuleId = 0
      }
  }
}

function deleteRule(ruleId) {
  ruleId = parseInt(ruleId)
    const index = form.rules.indexOf(ruleId)
    if (index !== -1) {
        form.rules.splice(index, 1)
    }
}

</script>

<template>
    <div>
        <h1>Edit a Tax group</h1>
        <form @submit.prevent="form.put('/tax-groups/' + props.groupId)">
            <label>
                Name:
                <input type="text" v-model="form.name">
                <div v-if="form.errors.name">{{ form.errors.name }}</div>
            </label>
            <br>
            <label>
                Rule:
                <select v-model="selectedRuleId">
                    <option value="0">Select a rule</option>
                    <option v-for="(ruleName, ruleId) in props.taxRules" :key="ruleId" :value="ruleId">
                        {{ ruleName }}
                    </option>
                </select>
                <button type="button" @click="addRule">Add Rule</button>
                <div v-if="form.errors.rules">{{ form.errors.rules }}</div>
            </label>
            <br>
            <ul>
                <li v-for="rule in form.rules" :key="rule">{{ props.taxRules[rule] }} <button type="button" @click="deleteRule(rule)">Delete</button></li>
            </ul>
            <br>
            <button>Save Tax Group</button>
        </form>
    </div>
</template>