<template>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner nav-collapse" style="height: auto;">
            <ul class="nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="/users/list/">Users List</a></li>
                <li><a href="/profile/">Profile</a></li>
                <li><a href="/logout">Log Out</a></li>
                <li><a href="/home"> Log In</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
