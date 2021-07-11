using NUnit.Framework;
using OpenQA.Selenium;
using OpenQA.Selenium.Support.UI;

namespace Almostengr.RhtServicesTest
{
    public class ContactFormTest : BaseTest
    {
        private IWebDriver driver = null;

        [OneTimeSetUp]
        public void Setup()
        {
            driver = StartBrowser();
        }

        [Test]
        public void ProperFormSubmission()
        {
            GoHome(driver);

            driver.FindElement(By.ClassName("navbar-toggler")).Click();
            
            driver.FindElement(By.LinkText("Contact")).Click();

            driver.FindElement(By.Name("customerfirst")).SendKeys("RHT");
            driver.FindElement(By.Name("customerlast")).SendKeys("Tester");
            driver.FindElement(By.Name("emailaddress")).SendKeys("tester@thealmostengineer.com");
            driver.FindElement(By.Name("phonenumber")).SendKeys("334-555-1234");

            IWebElement textmsgElement = driver.FindElement(By.Name("textmessage"));
            SelectElement textMsgSelect = new SelectElement(textmsgElement);
            textMsgSelect.SelectByText("Yes");

            string lorumIpsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et convallis ex, non porta dui. Quisque sodales volutpat mi, quis tempor nulla laoreet in. Curabitur eget orci id sapien dapibus scelerisque quis non urna. Vivamus pretium tortor id posuere eleifend. Sed ornare tortor in sem venenatis vestibulum. Duis porta sit amet dolor vel finibus. Nulla ut metus magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus diam lacus, sodales id aliquam at, euismod quis dui. Maecenas iaculis molestie rutrum.";
            driver.FindElement(By.Name("jobdescription")).SendKeys(lorumIpsum);

#if RELEASE
            driver.FindElement(By.Name("customerfirst")).Submit();

            driver.FindElement(By.Id("successmessage"));
#endif

            Assert.Pass();
        }

        [OneTimeTearDown]
        public void OneTimeTearDown()
        {
            CloseBrowser(driver);
        }
    }
}