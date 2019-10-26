<template>
    <div class="card mt-3">
        <div class="card-header">Ingredients</div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3 border-dark">
                    <v-select v-model="selected" label="name" :filterable="false" :options="options" @search="onSearch" max-height="200px" @input="setSelected">
                        <template slot="no-options">
                            Buscando ingredientes..
                        </template>
                        <template slot="option" slot-scope="option">
                            <div class="d-center">
                                {{ option.name }}
                            </div>
                        </template>
                        <template slot="selected-option" slot-scope="option">
                            <div class="selected d-center">
                                {{ option.name }}
                            </div>
                        </template>
                    </v-select>
                </div>
                <div class="col-12">
                    <div id="table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(el,index) in arr">
                                <td>{{ el.name }}<input type="hidden" readonly name="item_id[]" v-model="el.ID"></td>
                                <td><input type="number" class="form-control form-control-sm" name="item_qty[]" v-model.number="el.qty"></td>
                                <td><button type="button" class="btn btn-secondary" @click="removeItem(index)">Delete</button></td>
                            </tr>
                            <tr>
                                <td colspan="3" v-show="arr.length<1">
                                    Agregue items a la receta
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import 'vue-select/dist/vue-select.css';

    import Vue from 'vue'
    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)

    export default {
        data(){
            return{
                selected: null,
                options: [],
                current:{
                    ID: '',
                    qty:'',
                    name:''},
                arr:[]
            }
        },

        methods: {
            addCurrent() {
                var self = this
                var exist = false;
                self.arr.filter(function (ing) {
                    if(ing.ID == self.current.ID){
                        exist = true;
                        ing.qty+=(1);
                    }

                });
                if(!exist)
                    this.arr.push(JSON.parse(JSON.stringify(this.current)));
                $('.vs__search').focus()
            },
            removeItem(index){
                this.arr.splice(index, 1);
            },
            setSelected(value) {
                this.current.ID=value.id;
                this.current.name=value.name;
                this.current.qty=1;
                this.selected=null;
                this.addCurrent();
            },
            onSearch(search, loading) {
                loading(true);
                this.search(loading, search, this);
            },
            search: _.debounce((loading, search, vm) => {
                fetch(
                    `/json/get_ingredients?q=${escape(search)}`
                ).then(res => {
                    res.json().then(json => (vm.options = json.items));
                    if(vm.options.length==1){
                        //this.setSelected(vm.options[0])
                    }
                    loading(false);
                });
            }, 350)
        },
        mounted(){

        }
    }
</script>
