using System;
using NUnit.Framework;
using OpenQA.Selenium;

namespace Almostengr.RhtServicesTest
{
    public class HomePageLinksTest : BaseTest
    {
        private IWebDriver driver = null;

        [OneTimeSetUp]
        public void Setup()
        {
            driver = StartBrowser();
        }

        [Test]
        public void TestRequestServiceButton()
        {
            // arrange

            // act
            GoHome(driver);

            driver.FindElement(By.ClassName("navbar-toggler")).Click();
            
            System.Collections.ObjectModel.ReadOnlyCollection<IWebElement> buttonElements = 
                driver.FindElements(By.TagName("button"));
            foreach(IWebElement button in buttonElements)
            {
                if (button.Text == "Request Services")
                {
                    button.Click();
                    break;
                }
            }

            IWebElement h1Element = driver.FindElement(By.TagName("h1"));
            System.Collections.ObjectModel.ReadOnlyCollection<IWebElement> iFrameElements = driver.FindElements(By.TagName("iframe"));

            // assert
            Assert.AreEqual("Get It Done, Without Headaches", h1Element.Text);
        }

        [Test]
        public void CheckCopyrightYear()
        {
            // arrange 

            // act
            GoHome(driver);
            
            string footerText = driver.FindElement(By.TagName("footer")).Text;

            // assert
            Assert.IsTrue(footerText.Contains(DateTime.Now.Year.ToString()));
        }

        [OneTimeTearDown]
        public void OneTimeTearDown()
        {
            CloseBrowser(driver);
        }
    }
}