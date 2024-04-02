<?php
//si le formulaire est réaffiché avec des infos en session,
// on supprime la variable $_SESSION['POST']
if (isset($_SESSION['POST'])) {
    unset ($_SESSION['POST']);
}
?>

</main>
<script type="text/javascript" src="/js/searchEmployeeByName.js"></script>
<footer>
    <h2>&copy; 2024 - Cooker</h2>
</footer>
</body>
</html


