
</div>
<script>
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');

            if(!sidebar.classList.contains('hidden')){
                sidebar.classList.add('absolute w-screen')
            }else{
                sidebar.classList.remove('absolute w-screen')
            }

           
        });
    </script>

</body>

</html>
