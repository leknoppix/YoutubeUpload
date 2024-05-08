export function confirmUrlDelete(formId)
{
    if (confirm('Êtes-vous sûr de vouloir supprimer cet élément?')) {
        document.getElementById('deleteForm_' + formId).submit();
    }
    return false;
}
