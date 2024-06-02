export function confirmUrlDelete(formId)
{
    if (confirm("Êtes-vous sûr de vouloir supprimer cet élément?\nCela ne supprimer pas les vidéos de votre chaine Youtube")) {
        document.getElementById('deleteForm_' + formId).submit();
    }
    return false;
}
