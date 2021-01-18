using System;
using NUnit.Framework;
using OpenQA.Selenium;
using OpenQA.Selenium.Chrome;
using OpenQA.Selenium.Support.UI;

namespace Almostengr.RhtServicesTest
{
    public class ContactFormTest : BaseTest
    {
        private IWebDriver driver = null;

        [OneTimeSetUp]
        public void Setup()
        {
            ChromeOptions options = new ChromeOptions();

            #if RELEASE
            options.AddArgument("--headless");
            #endif

            driver = new ChromeDriver(options);
            driver.Manage().Timeouts().ImplicitWait = TimeSpan.FromSeconds(15);
        }

        [Test]
        public void ProperFormSubmission()
        {
            driver.Navigate().GoToUrl("https://rhtservices.net/contact");

            driver.FindElement(By.Name("customerfirst")).SendKeys("RHT");
            driver.FindElement(By.Name("customerlast")).SendKeys("Tester");
            driver.FindElement(By.Name("emailaddress")).SendKeys("tester@rhtservices.net");
            driver.FindElement(By.Name("phonenumber")).SendKeys("334-555-1234");

            IWebElement textmsgElement = driver.FindElement(By.Name("textmessage"));
            SelectElement textMsgSelect = new SelectElement(textmsgElement);
            textMsgSelect.SelectByText("Yes");

            string lorumIpsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et convallis ex, non porta dui. Quisque sodales volutpat mi, quis tempor nulla laoreet in. Curabitur eget orci id sapien dapibus scelerisque quis non urna. Vivamus pretium tortor id posuere eleifend. Sed ornare tortor in sem venenatis vestibulum. Duis porta sit amet dolor vel finibus. Nulla ut metus magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus diam lacus, sodales id aliquam at, euismod quis dui. Maecenas iaculis molestie rutrum.";
            driver.FindElement(By.Name("jobdescription")).SendKeys(lorumIpsum);

            driver.FindElement(By.Name("customerfirst")).Submit();

            driver.FindElement(By.Id("successmessage"));
            Assert.Pass();
        }

        [OneTimeTearDown]
        public void OneTimeTearDown()
        {
            // driver = TestClose(driver);
            if (driver != null)
            {
                driver.Quit();
            }
        }
    }
}