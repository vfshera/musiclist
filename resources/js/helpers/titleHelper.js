export default {
    setSEO(liveSubject) {

        const PageTitle = document.querySelector('title')
        const OriginalTitle = "Tony Gregory | Tony On The Track"

        PageTitle.innerText = liveSubject +" - "+OriginalTitle;
    }
}
