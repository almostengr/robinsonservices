using System;
using OpenQA.Selenium;
using OpenQA.Selenium.Chrome;

namespace Almostengr.RhtServicesTest
{
    public class BaseTest
    {
        public IWebDriver StartBrowser()
        {
            IWebDriver driver = null;
            ChromeOptions options = new ChromeOptions();

#if RELEASE
            options.AddArgument("--headless");
#endif

            driver = new ChromeDriver(options);
            driver.Manage().Timeouts().ImplicitWait = TimeSpan.FromSeconds(15);

            driver.Navigate().GoToUrl("http://192.168.57.117:8082");

            return driver;
        }

        public void GoHome(IWebDriver driver)
        {
            driver.FindElement(By.LinkText("RHT Services LLC")).Click();
        }

        public void CloseBrowser(IWebDriver driver)
        {
            if (driver != null)
            {
                driver.Quit();
            }
        }
    }
}