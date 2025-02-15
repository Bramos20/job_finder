const puppeteer = require('puppeteer');

(async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    await page.goto('https://remoteok.com/remote-jobs'); // Adjust URL as needed

    const jobs = await page.evaluate(() => {
        return Array.from(document.querySelectorAll('.job')).map(job => ({
            title: job.querySelector('.job-title')?.innerText || '',
            company: job.querySelector('.company')?.innerText || '',
            link: job.querySelector('.apply-link a')?.href || '',
            category: job.querySelector('.category')?.innerText.toLowerCase() || '',
            salary: job.querySelector('.salary')?.innerText.replace(/\D/g, '') || '0'
        }));
    });

    console.log(JSON.stringify(jobs, null, 2));

    await browser.close();
})();
