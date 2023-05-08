<script setup>

import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

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
<AppLayout title="Edit tax group">
    <div class="container">
        <div class="box">
            <h1>Edit tax group</h1>
            <form @submit.prevent="form.put('/tax-groups/' + props.groupId)">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" :class="'form-control'+(form.errors.name?' is-invalid':'')" id="name" v-model="form.name">
                    <div class="invalid-feedback">{{ form.errors.name }}</div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="rules">Tax Rules</label>
                        <select :class="'form-control'+(form.errors.rules?' is-invalid':'')" id="rules" v-model="selectedRuleId">
                            <option value="0">Select a rule</option>
                            <option v-for="(ruleName, ruleId) in props.taxRules" :key="ruleId" :value="ruleId">
                                {{ ruleName }}
                            </option>
                        </select>
                        <div class="invalid-feedback">{{ form.errors.rules }}</div>
                    </div>
                    <div class="form-group col-2">
                        <label>&nbsp;</label>
                        <button type="button" class="form-control btn btn-primary" @click="addRule"><i class="fas fa-plus"></i> Rule</button>
                    </div>
                </div>
                <br>
                <div v-if="form.rules.length > 0" class="form-group">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Rule name</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="rule in form.rules" :key="rule">
                                <th scope="row">{{ rule }}</th>
                                <td>{{ props.taxRules[rule] }}</td>
                                <td style="text-align:right;"><button type="button" class="btn btn-sm btn-outline-danger" title="Delete this tax rule" @click="deleteRule(rule)"><i class="fas fa-trash-alt"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</AppLayout>
</template>