export default {
    setSEO(liveSubject) {

        const PageTitle = document.querySelector('title')
        const OriginalTitle = PageTitle.innerText

        PageTitle.innerText = liveSubject +" - "+OriginalTitle;
    }
}
