<template>
    <v-row>

        <sidebar></sidebar>

        <v-col md="9" class="mt-3 mb-3">
            test
            <v-row>
               test msg
            </v-row>
        </v-col>
    </v-row>
    <!-- /.row -->

</template>

<script>
    import Sidebar from "../components/Sidebar";

    export default {
        data() {
            return {
                products: {}
            }
        },
        mounted() {
            axios.get('/api/products')
                .then(response => {
                    this.products = response.data.data;
                });
        },
        components: {
            'sidebar': Sidebar
        }
    }
</script>
